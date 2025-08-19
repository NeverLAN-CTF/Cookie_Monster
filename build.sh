#!/bin/bash

# Build script for Cookie Monster Challenge

set -e

echo "Building Cookie Monster Challenge..."

# Build the Docker image
docker build -t cookie-monster .

echo "Build completed successfully!"
echo ""
echo "To run the challenge:"
echo "   docker run -p 80:80 cookie-monster"
echo ""
echo "Access the challenge at: http://localhost"
echo ""
echo "To run with a custom flag:"
echo "   docker run -p 80:80 -e FLAG='flag{custom_flag}' cookie-monster"
