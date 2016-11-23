# example-rest-client

This is a very simple webapp, to assist with travel planning
amongst the Southern Gulf Islands. The data supplied is old, so don't
rely on it for a current trip!

A model of the schedule is not provided here - it is managed by a
remote server, which we connect to.

This webapp is built on top of the CI3 starter3, and adds or changes the
following:

/application
    /controllers
        Welcome.php
    /models
        Ferryschedule.php
    /views
        planner.php
        show_results.php
/public
    /assets
        ferry.png

This incorporates an older version of Phil Sturgeon's REST client.

WORK-IN-PROGRESS