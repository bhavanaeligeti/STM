class ServiceProvider:
    def __init__(self):
        self.services = {}

    def register_service(self, service_name, service):
        self.services[service_name] = service

    def get_service(self, service_name):
        return self.services.get(service_name)


class MyService:
    def __init__(self, service_name):
        self.service_name = service_name

    def perform_task(self):
        print(f"Performing task for service: {self.service_name}")


# Usage example
service_provider = ServiceProvider()

# Register services
service_provider.register_service("service1", MyService("Service 1"))
service_provider.register_service("service2", MyService("Service 2"))

# Get and use services
service1 = service_provider.get_service("service1")
if service1:
    service1.perform_task()

service2 = service_provider.get_service("service2")
if service2:
    service2.perform_task()

# Try to get a non-existent service
nonexistent_service = service_provider.get_service("nonexistent_service")
if not nonexistent_service:
    print("Service does not exist.")
