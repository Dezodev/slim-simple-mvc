let mix = require('laravel-mix');

// Disable OS notifications
mix.disableNotifications();

// Register asset files
mix.sass('src/assets/scss/app.scss', 'css')
    .setPublicPath('public');