class Api::V1::MessagesController < Api::BaseController
	before_filter :authenticate_runner!
	
	def create
		params["sender_id"] = current_runner.id

		message = Message.new(create_message_parameters)

		if message.save
			render json: {success: true, message: message} and return
    else
    	render json: {success: false, message: message.errors.messages} and return
    end
	end

	def approve
		@message = current_runner.messages.where(id: params[:message_id]).first
		binding.pry
		@message.update_attributes(status: Message::STATUS[:approved])
		render json: {success: true}
	end

	def reject
		@message = current_runner.messages.where(id: params[:message_id]).first
		@message.update_attributes(status: Message::STATUS[:rejected])
		render json: {success: true}
	end

	private
	
	def create_message_parameters
		params.require(:sender_id)
		params.require(:receiver_id)
		params.require(:message)
		params.require(:speed)
		params.require(:knowledge)
		params.require(:race_id)
		params.permit(:sender_id, :receiver_id, :message, :speed, :knowledge, :race_id)
	end
end
