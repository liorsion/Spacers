class AddRaceToMessage < ActiveRecord::Migration
  def change
  	change_table(:messages) do |t|
  		t.integer :race_id
  	end
  end
end
