import feedparser

url = input("Enter RSS feed URL: ")
try:
    feed = feedparser.parse(url)
    print("Feed Title:", feed.feed.get('title', 'No title'))
    print("Articles:")
    for entry in feed.entries:
        print("-", entry.get('title', 'No title'))
except Exception as e:
    print(f"Error: {e}")
