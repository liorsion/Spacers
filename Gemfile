source 'https://rubygems.org'
ruby "2.0.0"

# Bundle edge Rails instead: gem 'rails', github: 'rails/rails'
gem 'rails', '4.0.0'
gem 'devise'
gem 'rails_12factor', group: :production

# Use postgresql as the database for Active Record
gem 'pg'

# Use SCSS for stylesheets
gem 'sass-rails', '~> 4.0.0'

# Use Uglifier as compressor for JavaScript assets
gem 'uglifier', '>= 1.3.0'

# Use CoffeeScript for .js.coffee assets and views
#gem 'coffee-rails', '~> 4.0.0'

# See https://github.com/sstephenson/execjs#readme for more supported runtimes
gem 'therubyracer', platforms: :ruby

# Use jquery as the JavaScript library
gem 'jquery-rails'

# Turbolinks makes following links in your web application faster. Read more: https://github.com/rails/turbolinks
gem 'turbolinks'

# Build JSON APIs with ease. Read more: https://github.com/rails/jbuilder
gem 'jbuilder', '~> 1.2'

group :doc do
  # bundle exec rake doc:rails generates the API under doc/api.
  gem 'sdoc', require: false
end

group :development do
	gem 'growl'
	gem 'better_errors'
  gem 'binding_of_caller'
  gem 'meta_request'
  gem 'rb-inotify', :require => false
  gem 'rb-fsevent', :require => false
  gem 'rb-fchange', :require => false
end

group :development, :test do
  gem 'guard'
  gem 'pry-rails'
	gem 'rspec-rails', '2.14'
  gem 'guard-rspec'
  gem 'ruby_gntp'
  gem 'guard-spork'
  gem 'rr'
  gem 'factory_girl'
  gem "factory_girl_rails"
  gem 'spork-rails', github: 'railstutorial/spork-rails'
  gem 'pry'
  gem 'pry-remote'
  gem 'pry-nav'
  gem 'pry-stack_explorer'
  gem "faker"
end


group :test do
  gem 'test_after_commit'
end
# Use ActiveModel has_secure_password
gem 'bcrypt-ruby', '~> 3.0.0'

group :production do
  gem 'thin'  
  gem 'newrelic_rpm'
end

# Use unicorn as the app server
# gem 'unicorn'

# Use Capistrano for deployment
# gem 'capistrano', group: :development

# Use debugger
gem 'debugger', group: [:development, :test]
