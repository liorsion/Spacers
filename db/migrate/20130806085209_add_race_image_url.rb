class AddRaceImageUrl < ActiveRecord::Migration
  def change
  	change_table(:races) do |t|
  		t.string :image_url
  	end
  end
end
