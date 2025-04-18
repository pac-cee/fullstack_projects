"""
Project 097: Basic Weather Fetcher
This script fetches current weather data for a city using the OpenWeatherMap API.
"""
import requests

def main():
    city = input("Enter city name: ").strip()
    api_key = input("Enter your OpenWeatherMap API key: ").strip()
    if not city or not api_key:
        print("City and API key are required.")
        return
    url = f"https://api.openweathermap.org/data/2.5/weather?q={city}&appid={api_key}&units=metric"
    try:
        response = requests.get(url)
        data = response.json()
        if data.get('cod') != 200:
            print(f"Error: {data.get('message', 'Failed to fetch weather data.')}")
            return
        print(f"Weather in {city}: {data['weather'][0]['description']}, Temperature: {data['main']['temp']}°C")
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    main()
