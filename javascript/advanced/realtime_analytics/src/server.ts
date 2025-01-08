/**
 * Real-time Analytics Platform
 * Features:
 * - Event Processing
 * - Real-time Dashboards
 * - Data Aggregation
 * - Custom Metrics
 * - Alerting System
 */

import express from 'express';
import { Server } from 'socket.io';
import { PrismaClient } from '@prisma/client';
import { createClient } from 'redis';
import { Kafka } from 'kafkajs';
import { Container } from 'typedi';
import { useExpressServer } from 'routing-controllers';
import { createBullBoard } from '@bull-board/api';
import { BullAdapter } from '@bull-board/api/bullAdapter';
import Queue from 'bull';

import { EventProcessor } from './services/EventProcessor';
import { MetricsAggregator } from './services/MetricsAggregator';
import { AlertManager } from './services/AlertManager';
import { DashboardManager } from './services/DashboardManager';
import { logger } from './utils/logger';

class AnalyticsPlatform {
    private app: express.Application;
    private io: Server;
    private prisma: PrismaClient;
    private kafka: Kafka;
    private eventProcessor: EventProcessor;
    private metricsAggregator: MetricsAggregator;
    private alertManager: AlertManager;
    private dashboardManager: DashboardManager;

    constructor() {
        this.app = express();
        this.prisma = new PrismaClient();
        this.setupDependencies();
        this.setupMiddleware();
        this.setupRoutes();
        this.setupWebSockets();
        this.setupQueues();
    }

    private async setupDependencies() {
        // Setup Kafka
        this.kafka = new Kafka({
            clientId: 'analytics-platform',
            brokers: ['localhost:9092']
        });

        // Setup Redis
        const redis = createClient({
            url: process.env.REDIS_URL
        });

        // Setup services
        this.eventProcessor = Container.get(EventProcessor);
        this.metricsAggregator = Container.get(MetricsAggregator);
        this.alertManager = Container.get(AlertManager);
        this.dashboardManager = Container.get(DashboardManager);

        // Initialize services
        await Promise.all([
            this.eventProcessor.initialize(),
            this.metricsAggregator.initialize(),
            this.alertManager.initialize(),
            this.dashboardManager.initialize()
        ]);
    }

    private setupMiddleware() {
        this.app.use(express.json());
        this.app.use(express.urlencoded({ extended: true }));
        
        // Setup bull-board
        const { router } = createBullBoard([
            new BullAdapter(this.eventProcessor.queue)
        ]);
        this.app.use('/admin/queues', router);
    }

    private setupRoutes() {
        useExpressServer(this.app, {
            controllers: [__dirname + '/controllers/*.ts'],
            middlewares: [__dirname + '/middlewares/*.ts'],
            interceptors: [__dirname + '/interceptors/*.ts']
        });
    }

    private setupWebSockets() {
        this.io = new Server(this.app.listen(3000));
        
        this.io.on('connection', (socket) => {
            logger.info(`Client connected: ${socket.id}`);
            
            socket.on('subscribe', (dashboardId: string) => {
                this.dashboardManager.subscribeToDashboard(socket, dashboardId);
            });
            
            socket.on('disconnect', () => {
                this.dashboardManager.handleDisconnect(socket);
            });
        });
    }

    private setupQueues() {
        // Event processing queue
        const eventQueue = new Queue('event-processing', {
            redis: process.env.REDIS_URL
        });

        eventQueue.process(async (job) => {
            await this.eventProcessor.processEvent(job.data);
        });

        // Metrics aggregation queue
        const metricsQueue = new Queue('metrics-aggregation', {
            redis: process.env.REDIS_URL
        });

        metricsQueue.process(async (job) => {
            await this.metricsAggregator.aggregateMetrics(job.data);
        });
    }

    public async start() {
        try {
            await this.prisma.$connect();
            logger.info('Connected to database');
            
            const port = process.env.PORT || 3000;
            this.app.listen(port, () => {
                logger.info(`Server running on port ${port}`);
            });
        } catch (error) {
            logger.error('Failed to start server:', error);
            process.exit(1);
        }
    }
}

const platform = new AnalyticsPlatform();
platform.start(); 