## English version | Русская версия

Aggregator Service

This project is a REST API service that acts as a single access point for data from various external sources. Its main task is to asynchronously collect, unify, cache, and serve information (like news and weather) upon client request.

The project was created to demonstrate backend development skills, focusing on building reliable, maintainable, and high-performance systems.

🚀 Key Features

Aggregation: Collects data from multiple third-party APIs (NewsAPI.org and OpenWeatherMap).

Automation: Built-in scheduler (Cron) automatically runs data collection tasks on a schedule.

Performance: Efficient caching of "hot" data (news) in Redis for instant responses.

REST API: Provides collected data via a JSON API (/api/v1/news, /api/v1/weather).

Clean Architecture: Clear separation of responsibilities (Data Providers, Controllers, Models).

Environment: Fully configured local Docker environment using Laravel Sail.

🛠️ Tech Stack

Backend: PHP 8.3+ / Laravel 11

Database: MySQL (for data storage)

Cache: Redis (for caching API responses)

Infrastructure: Docker (Laravel Sail)

Automation: Cron + Laravel Scheduler

🏁 Local Installation & Setup

1. Clone the repository:

git clone [https://github.com/saken555/AggregatorService.git](https://github.com/saken555/AggregatorService.git)
cd AggregatorService




2. Copy the environment file:

cp .env.example .env




3. Set API keys:
Open the .env file and add your keys from the services:

NEWS_API_KEY=YOUR_NEWSAPI_KEY_HERE
OPENWEATHERMAP_API_KEY=YOUR_OPENWEATHERMAP_KEY_HERE




4. Start the Docker containers:

./vendor/bin/sail up -d




(The first launch may take a few minutes to download the images)

5. Install dependencies:

./vendor/bin/sail composer install




6. Generate the application key:

./vendor/bin/sail artisan key:generate




7. Run the database migrations:

./vendor/bin/sail artisan migrate




8. Configure Cron (Automation):
To have data collection run automatically, add this line to your crontab (run crontab -e):

* * * * * cd /path/to/your/project/AggregatorService && ./vendor/bin/sail artisan schedule:run >> /dev/null 2>&1




(Replace /path/to/your/project with your actual path, e.g., /opt/lampp/htdocs)

🚀 Usage

The service will be available at http://localhost.

Manual Data Fetching (for testing)

You can run the data fetching manually at any time:

# Fetch news
./vendor/bin/sail artisan app:fetch-news

# Fetch weather
./vendor/bin/sail artisan app:fetch-weather




API Endpoints

The service provides the following JSON API endpoints:

1. Get News

URL: GET /api/v1/news

Description: Returns the 25 most recent news articles. The response is cached in Redis for 10 minutes.

Example Request:

curl http://localhost/api/v1/news




2. Get Weather

URL: GET /api/v1/weather

Description: Returns the most recent saved weather observation.

Example Request:

curl http://localhost/api/v1/weather



