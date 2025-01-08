const mongoose = require('mongoose');

const noteSchema = new mongoose.Schema({
    title: {
        type: String,
        required: true,
        trim: true
    },
    content: {
        type: String,
        required: true
    },
    category: {
        type: String,
        trim: true
    },
    tags: [{
        type: String,
        trim: true
    }],
    attachments: [{
        filename: String,
        path: String,
        mimetype: String
    }],
    owner: {
        type: mongoose.Schema.Types.ObjectId,
        required: true,
        ref: 'User'
    }
}, {
    timestamps: true
});

// Add text index for search functionality
noteSchema.index({ title: 'text', content: 'text' });

module.exports = mongoose.model('Note', noteSchema); 