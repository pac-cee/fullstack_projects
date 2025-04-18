"""
Project 098: Basic Currency Converter
This script converts an amount from one currency to another using exchangerate.host API.
"""
import requests

def main():
    from_currency = input("From currency (e.g., USD): ").strip().upper()
    to_currency = input("To currency (e.g., EUR): ").strip().upper()
    try:
        amount = float(input("Amount: ").strip())
    except ValueError:
        print("Invalid amount.")
        return
    url = f"https://api.exchangerate.host/convert?from={from_currency}&to={to_currency}&amount={amount}"
    try:
        response = requests.get(url)
        data = response.json()
        if data.get('success'):
            print(f"{amount} {from_currency} = {data['result']} {to_currency}")
        else:
            print("Conversion failed.")
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    main()
