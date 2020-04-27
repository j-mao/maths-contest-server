# maths-contest-server
Contest management system for maths contests

## Setting up

### Web server
An apache server is preferred. Nginx and other servers might work, but have not been tested.

### Database
There is an underlying MySQL database to handle all the data.

All database queries will be made to the database called `contest`.

Many tables are required: you can run `init_database.sql` to set them up.

## Contributing
Use git or something

## Acknowledgement
Web design is based on [CMS](https://github.com/cms-dev/cms) and done using [Bootstrap](https://github.com/twbs/bootstrap).
