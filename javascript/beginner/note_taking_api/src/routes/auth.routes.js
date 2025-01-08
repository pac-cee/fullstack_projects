const express = require('express');
const { body } = require('express-validator');
const router = express.Router();
const { register, login } = require('../controllers/auth.controller');

// Validation middleware
const validateRegistration = [
    body('username').trim().isLength({ min: 3 }),
    body('email').isEmail().normalizeEmail(),
    body('password').isLength({ min: 6 })
];

// Routes
router.post('/register', validateRegistration, register);
router.post('/login', login);

module.exports = router; 