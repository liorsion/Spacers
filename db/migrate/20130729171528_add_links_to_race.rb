class AddLinksToRace < ActiveRecord::Migration
  def change
  	add_column :races, :url, :string
  	add_column :races, :terms_url, :string
  end
end
