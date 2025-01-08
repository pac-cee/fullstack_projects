from flask import Flask
from flask_restful import Api
from flask_sqlalchemy import SQLAlchemy
from flask_jwt_extended import JWTManager

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///tasks.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['JWT_SECRET_KEY'] = 'your-secret-key'  # Change this in production

db = SQLAlchemy(app)
api = Api(app)
jwt = JWTManager(app)

# Import routes after db initialization to avoid circular imports
from routes import initialize_routes

initialize_routes(api)

if __name__ == '__main__':
    with app.app_context():
        db.create_all()
    app.run(debug=True) 