# ITRACKB4 - LA13

J1: Your HomeController is not a resource controller. Name two things an index() on a resource controller does that yours does not have to.**

The `index()` in my MovieController has to read the search, genre, featured and sort values from the request and use them to filter the movies. It also has to load the movies together with their genre and split them into pages with `paginate()`. My HomeController only shows the front page and the two counts, so it does none of these things.

J2: Your pagination links lost the search term until you added one method. Say what those links contained before, and what the controller therefore received.**

Before the fix, the pagination links only contained `?page=2` and nothing else, so the search term was missing. When I clicked page 2, the controller received only the page number and no search value. It then showed my whole movie list again with an empty search box. I fixed it by adding `withQueryString()` after `paginate()`, which keeps the search, filter and sort in every link.

J3: A misspelled sort value does not break your page. Explain why that is worse than an error, and what your allowed list does about it.**

On SQLite, a wrong sort name like `?sort=titel` gives no error, and the movies just come back in no particular order. That is worse than an error because nothing tells me something is wrong, so nobody would notice or report it. My allowed list checks the sort value against `title`, `year` and `rating`, and anything else falls back to `title`. This way my movies always come back sorted, even if the address is misspelled.