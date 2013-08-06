class Api::V1::RacesController < ApplicationController
	respond_to :json

	def levels
		@race = Race.find(params[:id])
		render json: {knowledge_levels: @race.knowledge_levels, speed_levels: @race.speed_levels}
	end

	def create
		
		race = Race.new(create_race_parameters)

		if race.save
			render json: {success: true, race: race} and return
    else
    	render json: {success: false, message: race.errors.messages} and return
    end
	end

	private
	

	def create_race_parameters
		params.require(:name)
		params.require(:terms_url)
		params.require(:url)
		params.require(:image_url)
		params.permit(:name, :url, :terms_url, :image_url, :startTime, :lat, :lng)
	end
end
