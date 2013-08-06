class AddMessageStatus < ActiveRecord::Migration
  def change
  	change_table(:messages) do |t|
  		t.integer :status, default: 0
  	end
  end
end
