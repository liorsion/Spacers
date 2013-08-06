class CreateParticipations < ActiveRecord::Migration
  def change
    create_table :participations do |t|
    	t.belongs_to :race
      t.belongs_to :runner
      t.boolean :racer
      t.timestamps
    end
  end
end
