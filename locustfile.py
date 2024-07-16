from locust import HttpUser, task, between

class WebsiteUser(HttpUser):
    wait_time = between(1, 5)

    @task
    def load_homepage(self):
        self.client.get("/")

    @task
    def load_login_page(self):
        self.client.get("/login")

    @task
    def load_register_page(self):
        self.client.get("/register")

    
