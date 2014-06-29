# Traction

A WordPress framework for the impatient.

## Getting Started

1. Make a new folder in your theme's root directory called `inc`
2. Clone this folder into `inc/traction-lib`
3. Include `traction.core-options.php` and `traction.core.php` or run with the [sample functions.php file](http://github.com/tshedor/traction/blob/master/samples/functions.php)
4. Move the `scss-includes` folder from `traction-lib/samples` into `inc/scss-includes`
5. Move `style.scss` to `inc/style.scss`
6. Edit `scss-includes/_variables.scss` and `
7. Compile and profit.

Your directory structure should look like this:

```
theme/
├── functions.php
├── inc/
│   └── scss-includes/
│   └── style.scss
│   └── traction-lib/
```

## Documentation

TBD on an explicit explanation of functions, SCSS mixins, etc. Please review the inline documentation in the meantime.

## Why?

This has been a personal framework that I've been hacking together for the last two years in order to expedite my own theme building. It includes a lot of code I've found relevant and helpful - from a variety of sources like the Codex, StackExchange, StackOverflow, various blogs, various plugins, and more - and some of it is uncredited.

**Traction is not meant for personal gain**. If I've pinched your code without giving you proper due, please notify me immediately, and I will either remove it or add the credit.

The goal of this framework is to help new theme builders spend less time navigating back-end WP code and to spend more time creating a refined front-end experience.

## License

MIT License except where noted or for code I have not written.
