// JavaScript Document

/*global jQuery:true*/

/*
 * contactable 1.2.1 - jQuery Ajax contact form
 *
 * Copyright (c) 2009 Philip Beel (http://www.theodin.co.uk/)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Revision: $Id: jquery.contactable.js 2010-01-18 $
 *
 */

//extend the plugin
(function($){
    'use strict';

    //define the new for the plugin ans how to call it
    $.fn.contactable = function(options) {

        //set default options
        var defaults = {
            name: 'Your Name',
            email: 'Your E-mail',
            topic: 'Topic',
            yourfeedback : 'Your Message',
            send: 'Send',
            subject : 'A contactable message',
            recievedMsg : 'Thank you for your message',
            notRecievedMsg : 'Sorry but your message could not be sent, try again later',
            disclaimer: 'Please feel free to get in touch with us!',
            hideOnSubmit: true,
            callback: '',
            topics: ['General']
        };

        //call in the default otions
        var options = $.extend(defaults, options);

        //act upon the element that is passed into the design
        return this.each(function(options) {
            var topics_options = '',
                topic,
                hide_function,
	    overlay,
	    contactable,
	    contactForm,
                i;

            for (var i in defaults.topics) {
                topic = defaults.topics[i];
                topics_options += '<option value="' + topic + '">' + topic + '</option>';
            }
            //construct the form
            $(this).html('<div id="contactable" title="Click to send us a message"></div><form id="contactForm" method="" action=""><div id="loading"></div><div id="callback"></div><div class="holder"><p><label for="name">' + defaults.name + ' <span> * </span></label><input class="contact" name="name" /></p><p><label for="email">' + defaults.email + ' <span> * </span></label><input class="contact" name="email" /></p><p><label for="comment">' + defaults.yourfeedback + ' <span> * </span></label><textarea name="comment" class="comment" rows="4" cols="30" ></textarea></p><br /><p><label for="topic">' + defaults.topic + ' <span> * </span></label><select class="topic" name="topic">' + topics_options + '</select></p><p class="submit"><input class="submit" type="submit" value="' + defaults.send + '"/></p><p class="disclaimer">'+defaults.disclaimer+'</p></div></form>');
            hide_function = function() {
                $('#contactable').click();
            }

            overlay = $('#overlay');
            contactable = $('#contactable');
            contactForm = $('#contactForm');

            //show / hide function
            $('#contactable').toggle(function() {
                overlay.css({display: 'block'}).bind('click', hide_function);
                contactable.animate({"marginLeft": "+=382px"}, "slow");
                contactForm.animate({"marginLeft": "+=390px"}, "slow");
            }, function() {
                overlay.css({display: 'none'}).unbind('click', hide_function);
                contactForm.animate({"marginLeft": "-=390px"}, "slow");
                contactable.animate({"marginLeft": "-=382px"}, "slow");
            });

            //validate the form
            contactForm.validate({
                //set the rules for the fild names
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    comment: {
                        required: true
                    }
                },
                //set messages to appear inline
                messages: {
                    name: "",
                    email: "",
                    comment: ""
                },

                submitHandler: function() {
                    $('.holder').hide();
                    $('#loading').show();
                    $.post(
                        defaults.callback,
                        {
                            subject: defaults.subject,
                            name: $('#contactForm input[name=name]').val(),
                            email: $('#contactForm input[name=email]').val(),
                            topic: $('#contactForm input[name=topic]').val(),
                            comment: $('#contactForm input[name=comment]').val()
                        },
                        function(data){
                            $('#loading').css({display:'none'});
                            if (data === 'success') {
                                $('#callback').show().append(defaults.recievedMsg);
                                if (defaults.hideOnSubmit == true) {
                                    //hide the tab after successful submition if requested
                                    $('#contactForm').animate({dummy:1}, 2000).animate({"marginLeft": "-=450px"}, "slow");
                                    $('#contactable').animate({dummy:1}, 2000).animate({"marginLeft": "-=447px"}, "slow").animate({"marginLeft": "+=5px"}, "fast");
                                    $('#overlay').css({display: 'none'});
                                }
                            } else {
                                $('#callback').show().append(defaults.notRecievedMsg);
                            }
                        }
                    );
                }
            });
        });
    };
})(jQuery);
