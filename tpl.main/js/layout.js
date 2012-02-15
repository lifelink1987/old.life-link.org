// JavaScript Document

/*global colorbox:true, $, contactable_uri*/
colorbox = {
    config:{
        transition:'fade',
        minWidth:234
    },
    image:{
        maxWidth:'85%',
        maxHeight:'85%',
        photo:true
    },
    slideshow:{
        slideshow:true,
        slideshowSpeed:5000
    },
    text:{
        preloading:false,
        width:738,
        height:'85%',
        inline:true
    }
};

$(function(){
    'use strict';

    //Activate contact form
    $('#contact').contactable({
        subject: 'www.life-link.org Message',
        callback: contactable_uri
    });

    //Add page's sidebar
    $('#content section.sidebar.related')
    .first()
    .detach()
    .prependTo($('#sidebar'))
    .removeClass('sidebar');

    $('#content section.sidebar.related > div > ul')
    .detach()
    .appendTo($('#sidebar .related > div > ul'));

    $('#content section.sidebar.related').remove();
    $('#content section.sidebar').detach().prependTo($('#sidebar')).removeClass('sidebar');

    //Add page's TOC
    var toc_html = '',
        i = 1;

    $('#content section:not(.sidebar) > h1:not(.simple)').each(function() {
        var $this = $(this),
            id = $this.attr('id');

        if (!id) {
            id = 'heading_' + i;
            $this.attr('id', id);
        }
        toc_html += '<li><a href="#' + id + '">' + $this.text() + '</a></li>';
        i++;
    });

    if (i > 2) {
        toc_html = '<section class="toc"><h1>On this Page</h1><div><ul>' +
            toc_html +
            '</ul></div></section>';
        $('#sidebar').prepend(toc_html);
    }

    //Center images inside parent (for cropping purposes)
    $('.img_center img').imgCenter();

    //Activate tooltips
    $('#content a[title],#content div[title],#content span[title]').tipTip({maxWidth:'400px'});
    $('#footer a[title],#contactable').tipTip({maxWidth:'400px', defaultPosition:'right'});

    //Disable forms on submit
    $('form').submit(function(){
        $('input[type=submit]', this).attr('disabled', 'disabled');
    });
});

