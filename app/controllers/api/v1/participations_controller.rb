class Api::V1::ParticipationsController < Api::BaseController
	before_filter :authenticate_runner!

	def create
		render json: {success: false, message: "Runner already part of this race"} and return \
					if Participation.where(race_id: params[:race_id], runner_id: current_runner.id ).exists?
		params[:runner_id] = current_runner.id
		params[:racer] = params[:runner_type] == "racer" ? true : false
		participation = Participation.new(create_participation_parameters)

		if participation.save
			render json: {success: true, participation: participation} and return
    else
    	render json: {success: false, message: participation.errors.messages} and return
    end
	end

	private
	
	def create_participation_parameters
		params.require(:race_id)
		params.require(:racer)
		params.require(:runner_id)
		params.require(:speed)
		params.require(:knowledge)
		params.permit(:race_id, :racer, :runner_id, :speed, :knowledge)
	end
end
