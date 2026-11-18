# ITRACKB4 - LA14

F1: Authentication and authorisation are not the same. In one sentence each: what did this lesson give you, and what is still missing next meeting?

This lesson gave my movie app authentication, so it now knows who is asking through register, login and logout. What is still missing is authorisation, because any signed-in account can still add, edit and delete every movie, and next meeting we decide what each kind of user is allowed to do.

F2: Why does a successful login call session()->regenerate()? What goes wrong if you skip it?

After login, Laravel gives me a new session id and throws away the old one. If I skip it, someone who already knew my session id before I signed in would hold a signed-in session on my movie app, which is called session fixation.

F3: Why does a failed login use the same message for a wrong password and an unknown email?

My login says "The provided credentials do not match our records" for both cases. If it said "no such email", a stranger could guess emails one by one and learn who is registered in my app, but this message tells a real user to check both fields and tells a stranger nothing.

F4: Why do index and show stay public while create/edit/update/destroy use auth?

My movie list is a catalogue, so visitors must be able to browse it and open a movie without an account. Only create, store, edit, update and destroy change my data, so only those five routes are behind the auth middleware.

F5: You hid Add (and actions) for guests. Why is that not enough to secure those actions? What actually stops a stranger?

Hiding the Add button only changes what the page shows, but the address `/movies/create` still exists and a guest can type it. What actually stops a stranger is the `auth` middleware on those routes, which sends the guest to the login page before my controller runs.

F6: In screenshot 20 the route name was wrong. Why does auth middleware care that the route is named exactly login?

When the auth middleware stops a guest, Laravel redirects to the route named `login`, not to a path. When I renamed my route to `signin`, Laravel could not find a route called `login`, so I got the "Route [login] not defined" error from a line I never wrote.