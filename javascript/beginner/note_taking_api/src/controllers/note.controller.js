const Note = require('../models/note.model');
const { validationResult } = require('express-validator');

exports.createNote = async (req, res) => {
    try {
        const errors = validationResult(req);
        if (!errors.isEmpty()) {
            return res.status(400).json({ errors: errors.array() });
        }

        const note = new Note({
            ...req.body,
            owner: req.user._id
        });

        await note.save();
        res.status(201).json(note);
    } catch (error) {
        res.status(500).json({ error: 'Server error' });
    }
};

exports.getNotes = async (req, res) => {
    try {
        const match = {};
        const sort = {};

        // Filter by category
        if (req.query.category) {
            match.category = req.query.category;
        }

        // Search functionality
        if (req.query.search) {
            match.$text = { $search: req.query.search };
        }

        // Sort by date
        if (req.query.sortBy) {
            const parts = req.query.sortBy.split(':');
            sort[parts[0]] = parts[1] === 'desc' ? -1 : 1;
        }

        const notes = await Note.find({ 
            ...match,
            owner: req.user._id 
        }).sort(sort);

        res.json(notes);
    } catch (error) {
        res.status(500).json({ error: 'Server error' });
    }
};

exports.getNote = async (req, res) => {
    try {
        const note = await Note.findOne({ 
            _id: req.params.id,
            owner: req.user._id
        });

        if (!note) {
            return res.status(404).json({ error: 'Note not found' });
        }

        res.json(note);
    } catch (error) {
        res.status(500).json({ error: 'Server error' });
    }
};

exports.updateNote = async (req, res) => {
    try {
        const note = await Note.findOneAndUpdate(
            { _id: req.params.id, owner: req.user._id },
            req.body,
            { new: true, runValidators: true }
        );

        if (!note) {
            return res.status(404).json({ error: 'Note not found' });
        }

        res.json(note);
    } catch (error) {
        res.status(500).json({ error: 'Server error' });
    }
};

exports.deleteNote = async (req, res) => {
    try {
        const note = await Note.findOneAndDelete({
            _id: req.params.id,
            owner: req.user._id
        });

        if (!note) {
            return res.status(404).json({ error: 'Note not found' });
        }

        res.json({ message: 'Note deleted successfully' });
    } catch (error) {
        res.status(500).json({ error: 'Server error' });
    }
}; 