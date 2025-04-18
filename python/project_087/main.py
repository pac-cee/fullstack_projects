import http.server
import socketserver
import os

port = int(input("Enter port to serve on (e.g., 8000): "))
dir_path = input("Enter directory to serve (leave blank for current directory): ") or os.getcwd()
os.chdir(dir_path)
Handler = http.server.SimpleHTTPRequestHandler
with socketserver.TCPServer(("", port), Handler) as httpd:
    print(f"Serving HTTP on port {port} from '{dir_path}'. Press Ctrl+C to stop.")
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        print("\nServer stopped.")
