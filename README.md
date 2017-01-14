[![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

slnm-base
===

Hi. I'm a starter theme called `slnm-base`. I'm a theme meant for hacking so don't use me as a Parent Theme. Instead try turning me into the next, most awesome, WordPress theme out there. That's what I'm here for.

My ultra-minimal CSS might make me look like theme tartare but that means less stuff to get in your way when you're designing your awesome theme. Here are some of the other more interesting things you'll find here:

* A just right amount of lean, well-commented, modern, HTML5 templates.
* A helpful 404 template.
* Custom template tags in `inc/template-tags.php` that keep your templates clean and neat and prevent code duplication.
* A script at `js/navigation.js` that makes your menu a toggled dropdown on small screens (like your phone), ready for CSS artistry. It's enqueued in `functions.php`.
* Smartly organized SMACCS CSS in the css folder that will help you to quickly get your design off the ground.
* Licensed under GPLv2 or later. :) Use it to make something cool.

Getting Started
---------------

Download `slnm-base` from GitHub. The first thing you want to do is copy the `slnm-base` directory and change the name to something else (like, say, `megatherium`), and then you'll need to do a five-step find and replace on the name in all the templates.

1. Search for `'slnm-base'` (inside single quotations) to capture the text domain.
2. Search for `slnm_base_` to capture all the function names.
3. Search for `Text Domain: slnm-base` in style.css.
4. Search for <code>&nbsp;slnm-base</code> (with a space before it) to capture DocBlocks.
5. Search for `slnm-base-` to capture prefixed handles.

OR

* Search for: `'slnm-base'` and replace with: `'megatherium'`
* Search for: `slnm_base_` and replace with: `megatherium_`
* Search for: `Text Domain: slnm-base` and replace with: `Text Domain: megatherium` in style.css.
* Search for: <code>&nbsp;slnm-base</code> and replace with: <code>&nbsp;Megatherium</code>
* Search for: `slnm-base-` and replace with: `megatherium-`

Then, update the stylesheet header in `style.css` with your own information. Next, update or delete this readme.

Now you're ready to go! The next step is easy to say, but harder to do: make an awesome WordPress theme. :)

Good luck!
