module Api
	class BaseController < ActionController::Base
		respond_to :json
	  # Prevent CSRF attacks by raising an exception.
	  # For APIs, you may want to use :null_session instead.
	  protect_from_forgery with: :exception

	  # if Rails.env.production? || Rails.env.test?
	  rescue_from Exception, :with => :error_render_method
	  # end

	  rescue_from(ActionController::ParameterMissing) do |parameter_missing_exception|
	  	error = {}
	    error[parameter_missing_exception.param] = ['parameter is required']
	    response = { errors: [error] }
	    render :json => response, status: :unprocessable_entity 
	  end

	  def error_render_method(error)
	  	binding.pry
	  	render :json => {rc: 0, success: false, message: error.message}
	  end

	  def authenticate_admin!
	    head :unauthorized and return false unless current_user.try(:admin?)
	  end
	end
end
