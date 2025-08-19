# Cookie Monster Challenge

A simple web challenge about cookies. Set the right cookie value to get the flag!

## Challenge Description

Cookie Monster is looking for his favorite red friend! Set a cookie named `Red_Guy's_name` with the right value to get the flag.

## Building and Running

### Using Docker

1. Build the Docker image:
```bash
docker build -t cookie-monster .
```

2. Run the container:
```bash
docker run -p 80:80 cookie-monster
```

3. Access the challenge at: http://localhost

### Using Custom Flag

To run with a custom flag, set the environment variable:

```bash
docker run -p 80:80 -e FLAG="flag{custom_flag_here}" cookie-monster
```

### Using Docker Compose

```bash
docker-compose up -d
```

### Using Build Script

```bash
./build.sh
```

## Solution

The challenge requires setting a cookie with a specific name and value pattern:

### Step 1: Understand the Cookie Requirement
- **Cookie Name**: `Red_Guy's_name`
- **Pattern**: The value must match the regex `/([Ee])lmo+/`

### Step 2: Set the Cookie
You can set the cookie using browser developer tools or JavaScript:

**Using Browser Developer Tools:**
1. Open Developer Tools (F12)
2. Go to Application/Storage tab
3. Find Cookies for localhost
4. Add a new cookie:
   - Name: `Red_Guy's_name`
   - Value: `Elmo` (or any value matching the pattern)

**Using JavaScript Console:**
```javascript
document.cookie = "Red_Guy's_name=Elmo";
```

### Step 3: Refresh the Page
After setting the cookie, refresh the page to see the flag and Elmo

## Valid Cookie Values
Any value that matches the pattern `/([Ee])lmo+/` will work:
- `Elmo`
- `elmo`
- `Elmo123`
- `elmo_friend`
- `ELMO`
- etc.


## File Structure

```
cookie-monster/
├── challenge.json      # Challenge metadata and configuration
├── Dockerfile         # Container definition
├── docker-compose.yml # Docker compose configuration
├── build.sh          # Build script
├── README.md         # This file
└── web/              # Application source code
    └── index.php     # Main PHP application
```

## Technical Details

- **Base Image**: PHP 8.2 with Apache
- **Port**: 80
- **Flag Environment Variable**: `FLAG`
- **Default Flag**: `flag{YummyC00k13s}`
- **Cookie Pattern**: `/([Ee])lmo+/`

## Difficulty Level

**Beginner** - This challenge introduces basic web concepts:
- Understanding HTTP cookies
- Using browser developer tools
- Basic regex pattern matching
- Web application interaction
