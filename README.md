# example-ferries-client

This is a very simple webapp, to assist with travel planning
amongst the Southern Gulf Islands. The data supplied is old, so don't
rely on it for a current trip!

A model of the schedule is not provided here - it is managed by a
remote server, which we connect to.

This webapp is derived from the example-ferries-standalone.
All data has been stripped, and instead the Ferryschedule
model has been modified to connect to our server instead.

    /application
        /config
            autoload.php ... add restful package
        /controllers
            Welcome.php ... The trip planner
        /models
            Ferryschedule.php ... client-side model
        /packages
            /restful       ... see below
                ....
        /views
            planner.php ... port selection view
            show_results.php ... selection results view
    /public
        /assets
            ferry.png

This incorporates a [packaging](https://github.com/jedi-academy/package-restful) 
of an older version of Phil Sturgeon's REST server,
which has now been [superceded](https://github.com/chriskacerguis/codeigniter-restserver).
Incorporating that will be the next iteration of this example, and won't happen this term.

##Deployment

This app is self-contained. Extract it somewhere suitable, and map
a virtual host (eg <code>client.local</code>) to its <code>public</code> folder.

You will need to configure your client-side webapp to reference this host.
