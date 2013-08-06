class AddMessageDetails < ActiveRecord::Migration
  def change
  	change_table(:messages) do |t|
  		t.integer :speed
  		t.integer :knowledge
  	end
  end
end
