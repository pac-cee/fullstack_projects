from flask_restful import Resource, reqparse
from flask_jwt_extended import jwt_required, create_access_token, get_jwt_identity
from models import User, Task
from app import db
import werkzeug
from datetime import datetime
from flask import jsonify

class UserRegistration(Resource):
    def post(self):
        parser = reqparse.RequestParser()
        parser.add_argument('username', required=True, help='Username cannot be blank')
        parser.add_argument('password', required=True, help='Password cannot be blank')
        args = parser.parse_args()

        if User.query.filter_by(username=args['username']).first():
            return {'message': 'User already exists'}, 400

        user = User(username=args['username'], 
                   password=werkzeug.security.generate_password_hash(args['password']))
        db.session.add(user)
        db.session.commit()

        return {'message': 'User created successfully'}, 201

class UserLogin(Resource):
    def post(self):
        parser = reqparse.RequestParser()
        parser.add_argument('username', required=True)
        parser.add_argument('password', required=True)
        args = parser.parse_args()

        user = User.query.filter_by(username=args['username']).first()
        if user and werkzeug.security.check_password_hash(user.password, args['password']):
            access_token = create_access_token(identity=user.id)
            return {'access_token': access_token}, 200
        return {'message': 'Invalid credentials'}, 401

class TaskResource(Resource):
    @jwt_required()
    def post(self):
        parser = reqparse.RequestParser()
        parser.add_argument('title', required=True, help='Title cannot be blank')
        parser.add_argument('description')
        parser.add_argument('category')
        parser.add_argument('due_date')
        args = parser.parse_args()

        user_id = get_jwt_identity()
        
        task = Task(
            title=args['title'],
            description=args['description'],
            category=args['category'],
            due_date=datetime.strptime(args['due_date'], '%Y-%m-%d') if args['due_date'] else None,
            user_id=user_id
        )
        
        db.session.add(task)
        db.session.commit()
        
        return {'message': 'Task created successfully'}, 201

    @jwt_required()
    def get(self):
        user_id = get_jwt_identity()
        tasks = Task.query.filter_by(user_id=user_id).all()
        return jsonify([{
            'id': task.id,
            'title': task.title,
            'description': task.description,
            'category': task.category,
            'due_date': task.due_date.strftime('%Y-%m-%d') if task.due_date else None,
            'completed': task.completed,
            'created_at': task.created_at.strftime('%Y-%m-%d %H:%M:%S')
        } for task in tasks])

class TaskDetailResource(Resource):
    @jwt_required()
    def get(self, task_id):
        user_id = get_jwt_identity()
        task = Task.query.filter_by(id=task_id, user_id=user_id).first()
        
        if not task:
            return {'message': 'Task not found'}, 404
            
        return {
            'id': task.id,
            'title': task.title,
            'description': task.description,
            'category': task.category,
            'due_date': task.due_date.strftime('%Y-%m-%d') if task.due_date else None,
            'completed': task.completed,
            'created_at': task.created_at.strftime('%Y-%m-%d %H:%M:%S')
        }

    @jwt_required()
    def put(self, task_id):
        parser = reqparse.RequestParser()
        parser.add_argument('title')
        parser.add_argument('description')
        parser.add_argument('category')
        parser.add_argument('due_date')
        parser.add_argument('completed', type=bool)
        args = parser.parse_args()

        user_id = get_jwt_identity()
        task = Task.query.filter_by(id=task_id, user_id=user_id).first()
        
        if not task:
            return {'message': 'Task not found'}, 404

        if args['title']:
            task.title = args['title']
        if args['description']:
            task.description = args['description']
        if args['category']:
            task.category = args['category']
        if args['due_date']:
            task.due_date = datetime.strptime(args['due_date'], '%Y-%m-%d')
        if args['completed'] is not None:
            task.completed = args['completed']

        db.session.commit()
        return {'message': 'Task updated successfully'}

    @jwt_required()
    def delete(self, task_id):
        user_id = get_jwt_identity()
        task = Task.query.filter_by(id=task_id, user_id=user_id).first()
        
        if not task:
            return {'message': 'Task not found'}, 404

        db.session.delete(task)
        db.session.commit()
        return {'message': 'Task deleted successfully'}

def initialize_routes(api):
    api.add_resource(UserRegistration, '/register')
    api.add_resource(UserLogin, '/login')
    api.add_resource(TaskResource, '/tasks')
    api.add_resource(TaskDetailResource, '/tasks/<int:task_id>') 