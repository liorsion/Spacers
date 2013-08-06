class RunnersController < ApplicationController
	def index
		@race = Race.find(params[:race_id])
		# @runners = Runner.racers(@race)
		# @runners = Runner.pacers(@race)
	end
end
