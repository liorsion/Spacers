class Race < ActiveRecord::Base
	has_many :runners, :through => :participations
	has_many :participations

	def knowledge_levels
		[
			"I know the trail very well",
		 	"Been on trail a few times",
		 	"Never been on the trail"
		]
	end

	def speed_levels
		[
			"top ten",
			"sub 20-hour",
			"sub 24-hour",
			"sub 30-hour",
			"no preference"
		]
	end
end
