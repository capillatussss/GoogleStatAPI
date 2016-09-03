# GoogleStatAPI
How many search results delivers a specific query - this API (written in PHP) knows the answer.   
Wrote it for a little game in July 2016.

## Function
It acts as a browser, which does not uses JavaScript. So it executes a google search query, follows the meta tag for a redirect in the <noscript> Element and queries a new google site with raw HTML. This is a lot easier for parsing the data. For parsing the normal google search result page you need an JS-Engine and an DOM-Simulator.   
Then it extracts the google search stats (e.g. About 1,400,000 results) and outputs the result.

## Usage
If you want to query the search pattern "weather" you need to execute following request:   
`GET [url-to-working-dir]/?s=weather`

Response:
`1,050,000,000`
