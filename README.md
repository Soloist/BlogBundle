Soloist blog bundle
===================

Works out of the box
---------------------
You should just extends the layout to integrate the bundle to your website.

Don't forget to defined the "soloist_blog_admin_thumb" in the avalanche imagine configuration:
```YAML
avalanche_imagine:
    filters:
        soloist_blog_admin_thumb:
            type: thumbnail
            options: { size: [200, 200], mode: outbound }
```
