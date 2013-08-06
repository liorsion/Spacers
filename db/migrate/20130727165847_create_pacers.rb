class CreatePacers < ActiveRecord::Migration
  def change
    create_table :runners do |t|
    	t.string 	:knowledge
    	t.string 	:firstName
    	t.string 	:lastName
    	t.string	:email
    	t.boolean :deleteRecord
    	t.string	:sex
    	t.string	:home
    	t.string	:speed
    	t.string	:status
    	t.string 	:experience
      t.timestamps
    end
  end
end
