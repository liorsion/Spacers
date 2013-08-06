class Participation < ActiveRecord::Base
	belongs_to :race
	belongs_to :runner

	scope :pacers, -> { where("racer = false") }
	scope :racers, -> { where("racer = true") }
end
