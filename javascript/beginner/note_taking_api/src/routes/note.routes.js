const express = require('express');
const { body } = require('express-validator');
const router = express.Router();
const auth = require('../middleware/auth.middleware');
const { 
    createNote,
    getNotes,
    getNote,
    updateNote,
    deleteNote
} = require('../controllers/note.controller');

// Validation middleware
const validateNote = [
    body('title').trim().notEmpty(),
    body('content').trim().notEmpty()
];

// Routes
router.post('/', auth, validateNote, createNote);
router.get('/', auth, getNotes);
router.get('/:id', auth, getNote);
router.put('/:id', auth, validateNote, updateNote);
router.delete('/:id', auth, deleteNote);

module.exports = router; 