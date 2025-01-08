const request = require('supertest');
const app = require('../src/server');
const mongoose = require('mongoose');
const User = require('../src/models/user.model');
const Note = require('../src/models/note.model');

let token;

beforeAll(async () => {
    await User.deleteMany();
    await Note.deleteMany();

    // Create test user and get token
    const response = await request(app)
        .post('/api/auth/register')
        .send({
            username: 'testuser',
            email: 'test@test.com',
            password: 'password123'
        });
    
    token = response.body.token;
});

describe('Note API Tests', () => {
    test('Should create new note', async () => {
        const response = await request(app)
            .post('/api/notes')
            .set('Authorization', `Bearer ${token}`)
            .send({
                title: 'Test Note',
                content: 'Test Content',
                category: 'Test'
            });

        expect(response.status).toBe(201);
        expect(response.body.title).toBe('Test Note');
    });

    test('Should get all notes', async () => {
        const response = await request(app)
            .get('/api/notes')
            .set('Authorization', `Bearer ${token}`);

        expect(response.status).toBe(200);
        expect(Array.isArray(response.body)).toBeTruthy();
    });
});

afterAll(async () => {
    await mongoose.connection.close();
}); 