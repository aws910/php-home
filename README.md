# php-home

## The code

The page is written to stand on its own.  The stylesheet and background image are the only internal dependencies.  A CDN is used to obtain bootstrap.

The "searchEngine" class was created for cleanliness.  It has a constructor, and two member functions:

### Constructor

Pretty self-explanatory.  Called when a new instance of the class is created.  All parameters are required:

btnLabel:  The text that should appear on the button.

btnStyle:  An array of the classes to apply to the button.

searchPattern1:  The first part of the destination URL, used to craft the direct search query.

searchPattern2:  The second part of the destination URL, if applicable.  Sometimes used to add extra parameters such as "image search".

postType: Specifies whether this search engine expects spaces to be converted to plus-signs.  

### displayButton

This function generates the HTML to display a button on the form.  It requires no parameters, and returns a string of the generated HTML.

### doSearch

This function is only called after data has been POSTed via the form.  It sends the search query to the appropriate searchEngine instance, which crafts the direct search URL from searchPattern1, the user-entered query, and searchPattern2.

Once the URL has been concatenated, the user is sent directly to the search results via the "header('location:" mechanism.

## About

This is a simple homepage, written in PHP, to serve my needs.  I use it several times a day.  Its origin can be traced back to my former homepage, Google.com.  Initially, I found Google to be a great start-page, since it was always the same... until they started changing the Google logo to reflect notable days according to their lexicon.  This became a supreme source of distraction to me, but I bore it.

A couple years later, I got into crafting, and discovered instructables.com.  It's an amazing website with a stellar community of knowledge-sharing folks.  Unfortunately, their homepage is rife with autoplays and FOUCs (flash of unstyled content).  On a mobile browser, this is especially unbearable.

After a few instances like my instructables.com experience, I realized that most of my needs could be met by targeted site-searches, but there didn't seeem to be anything that could do this.  Firefox tries to do this, but I found it to be inflexible.

In the end, as my dad said... "Necessity is a mother".  I made my own.  Here it is.


