class Race < ActiveRecord::Base
	has_many :runners, :through => :participations
	has_many :participations

	def remove_pacer(pacer)
		logger.info("Removing pacer #{pacer.id} from race #{self.id}")

		participation = self.participations.where("runner_id = %d" % [pacer.id]).first
		participation.delete if participation
	end

	def remove_runner(runner)
		logger.info("Removing runner #{runner.id} from race #{self.id}")

		participation = self.participations.where("runner_id = %d" % [runner.id]).first
		participation.delete if participation
	end

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
