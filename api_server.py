#!/usr/bin/env python3
"""
HTTP API Server for User and Group Information
Runs on localhost:3000
Requires authentication: username=test, password=abcABC123
"""

from http.server import HTTPServer, BaseHTTPRequestHandler
import json
import base64
import pwd
import grp


class APIHandler(BaseHTTPRequestHandler):
    # Authentication credentials
    VALID_USERNAME = "test"
    VALID_PASSWORD = "abcABC123"
    
    def do_POST(self):
        """Handle POST requests"""
        # Check authentication
        if not self.check_auth():
            self.send_auth_required()
            return
        
        # Parse the path
        if self.path == "/api/users":
            self.handle_users()
        elif self.path == "/api/groups":
            self.handle_groups()
        else:
            self.send_error(404, "Endpoint not found")
    
    def check_auth(self):
        """Check if the request has valid authentication"""
        auth_header = self.headers.get('Authorization')
        
        if auth_header is None:
            return False
        
        # Parse Basic Auth header
        try:
            auth_type, auth_string = auth_header.split(' ', 1)
            if auth_type.lower() != 'basic':
                return False
            
            # Decode base64 credentials
            decoded = base64.b64decode(auth_string).decode('utf-8')
            username, password = decoded.split(':', 1)
            
            # Validate credentials
            return username == self.VALID_USERNAME and password == self.VALID_PASSWORD
        except Exception:
            return False
    
    def send_auth_required(self):
        """Send 401 Unauthorized response"""
        self.send_response(401)
        self.send_header('WWW-Authenticate', 'Basic realm="API"')
        self.send_header('Content-type', 'application/json')
        self.end_headers()
        response = {"error": "Authentication required"}
        self.wfile.write(json.dumps(response).encode())
    
    def handle_users(self):
        """Return list of system users"""
        users_dict = {}
        
        # Get all users from /etc/passwd
        for user in pwd.getpwall():
            users_dict[str(user.pw_uid)] = user.pw_name
        
        self.send_json_response(users_dict)
    
    def handle_groups(self):
        """Return list of system groups"""
        groups_dict = {}
        
        # Get all groups from /etc/group
        for group in grp.getgrall():
            groups_dict[str(group.gr_gid)] = group.gr_name
        
        self.send_json_response(groups_dict)
    
    def send_json_response(self, data):
        """Send a JSON response"""
        self.send_response(200)
        self.send_header('Content-type', 'application/json')
        self.end_headers()
        self.wfile.write(json.dumps(data, indent=2).encode())
    
    def log_message(self, format, *args):
        """Override to customize logging"""
        print(f"[{self.log_date_time_string()}] {format % args}")


def run_server(port=3000):
    """Start the HTTP server"""
    server_address = ('localhost', port)
    httpd = HTTPServer(server_address, APIHandler)
    print(f"Server running on http://localhost:{port}")
    print("Endpoints:")
    print("  - POST http://localhost:3000/api/users")
    print("  - POST http://localhost:3000/api/groups")
    print("Authentication: username=test, password=abcABC123")
    print("\nPress Ctrl+C to stop the server")
    
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        print("\nShutting down server...")
        httpd.shutdown()


if __name__ == "__main__":
    run_server()
