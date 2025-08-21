# Challenge Deployment Makefile
# For CTFd Challenge Forge Plugin

# Default values
CHALLENGE_NAME ?= cookie-monster
FLAG ?= flag{YummyC00k13s}

# Challenge configuration
CHALLENGE_JSON = challenge.json
DOCKER_COMPOSE = docker-compose.yml
ENV_FILE = .env

.PHONY: help build deploy clean generate-env test validate

# Default target
help:
	@echo "Challenge Deployment Makefile"
	@echo "============================="
	@echo ""
	@echo "Available targets:"
	@echo "  help          - Show this help message"
	@echo "  build         - Build the challenge Docker image"
	@echo "  deploy        - Deploy the challenge with current settings"
	@echo "  clean         - Stop and remove containers and volumes"
	@echo "  generate-env  - Generate .env file from challenge.json"
	@echo "  test          - Test the challenge deployment"
	@echo "  validate      - Validate challenge.json schema"
	@echo ""
	@echo "Environment variables:"
	@echo "  CHALLENGE_NAME=$(CHALLENGE_NAME)"
	@echo "  FLAG=$(FLAG)"
	@echo ""
	@echo "Usage examples:"
	@echo "  make deploy FLAG=flag{custom_flag}"
	@echo "  make deploy CHALLENGE_NAME=team1-cookie-monster"

# Validate challenge.json schema
validate:
	@echo "Validating challenge.json..."
	@if [ ! -f $(CHALLENGE_JSON) ]; then \
		echo "Error: $(CHALLENGE_JSON) not found"; \
		exit 1; \
	fi
	@python3 -c "import json; json.load(open('$(CHALLENGE_JSON)'))" || (echo "Error: Invalid JSON in $(CHALLENGE_JSON)" && exit 1)
	@echo "Challenge configuration is valid"

# Generate .env file from challenge.json
generate-env: validate
	@echo "Generating .env file..."
	@echo "# Challenge Environment Variables" > $(ENV_FILE)
	@echo "# Generated from $(CHALLENGE_JSON)" >> $(ENV_FILE)
	@echo "" >> $(ENV_FILE)
	@echo "CHALLENGE_NAME=$(CHALLENGE_NAME)" >> $(ENV_FILE)
	@echo "FLAG=$(FLAG)" >> $(ENV_FILE)
	@echo "Generated $(ENV_FILE)"

# Build the challenge
build: validate
	@echo "Building challenge: $(CHALLENGE_NAME)"
	docker-compose build
	@echo "Build completed"

# Deploy the challenge
deploy: generate-env
	@echo "Deploying challenge: $(CHALLENGE_NAME)"
	@echo "Flag: $(FLAG)"
	docker-compose up -d
	@echo "Challenge deployed"
	@echo "Access at: http://localhost"

# Test the challenge deployment
test: deploy
	@echo "Testing challenge deployment..."
	@sleep 5
	@if curl -s http://localhost > /dev/null; then \
		echo "Challenge is accessible"; \
	else \
		echo "Challenge is not accessible"; \
		exit 1; \
	fi

# Clean up containers and volumes
clean:
	@echo "Cleaning up challenge deployment..."
	docker-compose down -v
	@echo "Cleanup completed"

# Full rebuild (clean + build + deploy)
rebuild: clean build deploy

# Show challenge status
status:
	@echo "Challenge Status:"
	docker-compose ps

# Show challenge logs
logs:
	docker-compose logs

# Show challenge logs (follow)
logs-follow:
	docker-compose logs -f

# Quick deployment with custom flag
quick-deploy:
	@if [ -z "$(FLAG)" ]; then \
		echo "Error: FLAG variable is required"; \
		echo "Usage: make quick-deploy FLAG=flag{your_flag}"; \
		exit 1; \
	fi
	@echo "Quick deploying with flag: $(FLAG)"
	@make clean
	@make deploy

# Generate challenge bundle for CTFd
bundle: validate
	@echo "Creating challenge bundle..."
	@mkdir -p bundle
	@cp -r web/ bundle/
	@cp $(CHALLENGE_JSON) bundle/
	@cp Dockerfile bundle/
	@cp docker-compose.yml bundle/
	@cp build.sh bundle/
	@cp README.md bundle/
	@cp Makefile bundle/
	@echo "Challenge bundle created in bundle/ directory"

# Install dependencies
install-deps:
	@echo "Installing development dependencies..."
	@if command -v python3 >/dev/null 2>&1; then \
		echo "Python3 is available"; \
	else \
		echo "Python3 is required but not installed"; \
		exit 1; \
	fi
	@if command -v docker >/dev/null 2>&1; then \
		echo "Docker is available"; \
	else \
		echo "Docker is required but not installed"; \
		exit 1; \
	fi
	@if command -v docker-compose >/dev/null 2>&1; then \
		echo "Docker Compose is available"; \
	else \
		echo "Docker Compose is required but not installed"; \
		exit 1; \
	fi
	@echo "All dependencies are available"
