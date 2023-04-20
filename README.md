# Oxbury Pathfind

Imagine representing a grid-shaped game map as a 2-dimensional array. Each value of this array is
boolean `true` or `false` representing whether that part of the map is passable (a floor) or blocked
(a wall).

Write a function that takes such a 2-dimensional array `A` and 2 vectors `P` and `Q`, with `0,0` being the top left corner of the map and returns the distance of the shortest path between those points, respecting the walls in the map.

eg. Given the map (where `.` is passable - `true`, and `#` is blocked - `false`)

```
. P . . .
. # # # .
. . . . .
. . Q . .
. . . . .
```

then `pathfind(A, P, Q)` should return `6`.

_Please avoid using libraries to implement the algorithmic side of this challenge, other libraries (such as PHPUnit or Jest for testing) are welcome._

## What to do

1. Clone/Fork this repo or create your own
2. Implement the function described above in any mainstream language you wish
3. Provide unit tests for your submission
4. Fill in the section(s) below

## Comments Section

<!---
Please fill in the sections below after you complete the challenge.
--->

### General Comments

Firstly, I would like to apologise for how long it has taken to do this test. There were outside factors (and one inside factor) that drew my attention away from the test itself. I apologise for the extremely long delay.

Secondly, I would like to state that I tried to keep the code down to the bare bones of PHP. I can demonstrate this task in most PHP frameworks (using framework componants) upon request.

### What I'm Pleased With
I'm pleased with multiple things about the test. I found the concept of the A* algorithem interesting and looked at what other competitors there were out there. As for my test, I refactored this quite a bit, starting out with just one function and refactoring it out to a class with multiple functions in which I could test against. I also like how easy it is to interpret what's going on within the `find` function.

### What I Would Have Done With More Time
I would have liked to have demonstrated how to do this in a PHP framework like Laravel where I'd use a collection to store the map instance and that would eliminate things like my search function through the array.

I also would have liked to have fixed a bug I found in where if you have unequal X columns in the map, It cannot find the neighbours when the below doesnt have that X axis coordinate. 

Thank you for the opportunity and please let me know if you have any feedback!
