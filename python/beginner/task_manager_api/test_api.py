import unittest
import json
from app import app, db
from models import User, Task

class TaskManagerTestCase(unittest.TestCase):
    def setUp(self):
        app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///test.db'
        app.config['TESTING'] = True
        self.app = app.test_client()
        with app.app_context():
            db.create_all()

    def tearDown(self):
        with app.app_context():
            db.session.remove()
            db.drop_all()

    def test_user_registration(self):
        response = self.app.post('/register',
            json={'username': 'testuser', 'password': 'testpass'})
        self.assertEqual(response.status_code, 201)
        self.assertIn(b'User created successfully', response.data)

    def test_user_login(self):
        # First register a user
        self.app.post('/register',
            json={'username': 'testuser', 'password': 'testpass'})
        
        # Then try to login
        response = self.app.post('/login',
            json={'username': 'testuser', 'password': 'testpass'})
        self.assertEqual(response.status_code, 200)
        self.assertIn(b'access_token', response.data)

    def get_auth_token(self):
        """Helper method to get authentication token"""
        self.app.post('/register',
            json={'username': 'testuser', 'password': 'testpass'})
        response = self.app.post('/login',
            json={'username': 'testuser', 'password': 'testpass'})
        return json.loads(response.data)['access_token']

    def test_create_task(self):
        token = self.get_auth_token()
        response = self.app.post('/tasks',
            headers={'Authorization': f'Bearer {token}'},
            json={
                'title': 'Test Task',
                'description': 'Test Description',
                'category': 'test',
                'due_date': '2024-12-31'
            })
        self.assertEqual(response.status_code, 201)
        self.assertIn(b'Task created successfully', response.data)

    def test_get_tasks(self):
        token = self.get_auth_token()
        # Create a task first
        self.app.post('/tasks',
            headers={'Authorization': f'Bearer {token}'},
            json={'title': 'Test Task', 'description': 'Test Description'})
        
        # Get all tasks
        response = self.app.get('/tasks',
            headers={'Authorization': f'Bearer {token}'})
        self.assertEqual(response.status_code, 200)
        tasks = json.loads(response.data)
        self.assertEqual(len(tasks), 1)
        self.assertEqual(tasks[0]['title'], 'Test Task')

    def test_update_task(self):
        token = self.get_auth_token()
        # Create a task first
        create_response = self.app.post('/tasks',
            headers={'Authorization': f'Bearer {token}'},
            json={'title': 'Test Task', 'description': 'Test Description'})
        
        # Get task ID from response
        tasks_response = self.app.get('/tasks',
            headers={'Authorization': f'Bearer {token}'})
        task_id = json.loads(tasks_response.data)[0]['id']
        
        # Update the task
        response = self.app.put(f'/tasks/{task_id}',
            headers={'Authorization': f'Bearer {token}'},
            json={
                'title': 'Updated Task',
                'completed': True
            })
        self.assertEqual(response.status_code, 200)
        
        # Verify the update
        get_response = self.app.get(f'/tasks/{task_id}',
            headers={'Authorization': f'Bearer {token}'})
        updated_task = json.loads(get_response.data)
        self.assertEqual(updated_task['title'], 'Updated Task')
        self.assertTrue(updated_task['completed'])

    def test_delete_task(self):
        token = self.get_auth_token()
        # Create a task first
        self.app.post('/tasks',
            headers={'Authorization': f'Bearer {token}'},
            json={'title': 'Test Task'})
        
        # Get task ID
        tasks_response = self.app.get('/tasks',
            headers={'Authorization': f'Bearer {token}'})
        task_id = json.loads(tasks_response.data)[0]['id']
        
        # Delete the task
        response = self.app.delete(f'/tasks/{task_id}',
            headers={'Authorization': f'Bearer {token}'})
        self.assertEqual(response.status_code, 200)
        
        # Verify task is deleted
        get_response = self.app.get(f'/tasks/{task_id}',
            headers={'Authorization': f'Bearer {token}'})
        self.assertEqual(get_response.status_code, 404)

if __name__ == '__main__':
    unittest.main() 