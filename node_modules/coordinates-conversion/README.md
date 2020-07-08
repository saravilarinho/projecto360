# Coordinates Converter

A utility library for helping convert coordinates from _D°M'S"_ (degrees, minutes and seconds) format to _DD_ (decimal degrees).

## Example: 

Let's say we have a coordinate in DMS format: **19°25'57.3"N 99°07'59.5"W**.
We can use the library to convert this format into decimal degrees.

First we import the library:
```js
const Coordinates = require('coordinates-converter');
```
A coordinate can be constructed from a string if it follows this format:

```js
const coordWithSymbols = new Coordinate('19°25\'57.3"N 99°07\'59.5"W'); 
// quotes or double quotes have to be escaped.

const coordWithSpaces = new Coordinate('19 25 57.3 N 99 07 59.5 W'); 
```
Currently, library only accepts orientations (N, S, E, W) 
proceeding the coordinate's numbers.

Once we have a coordinate constructed we can access it's properties:
```js
coordWithSpaces.latitude; // DMS { degrees: 19, minutes: 25, seconds: 57.3, orientation: 'N' }
coordWithSpaces.longitude; // DMS { degrees: 99, minutes: 7, seconds: 59.5, orientation: 'W' }
```

Each member of the coordinate is a DMS object. Which have it's own properties:
```js
coordWithSpaces.latitude.degrees; // 19
coordWithSpaces.latitude.minutes; // 25
coordWithSpaces.latitude.degrees; // 57.3
coordWithSpaces.latitude.orientation; // 'N'
```

To convert format we use function `.toDd()`:
````js
coordWithSpaces.toDd() // [ 19.432583, -99.133194 ]
````
