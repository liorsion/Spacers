class CreateRaces < ActiveRecord::Migration
  def change
    create_table :races do |t|
    	t.string :name
    	t.datetime :startTime
    	t.float :lat
    	t.float :lng
      t.timestamps
    end
  end
end
