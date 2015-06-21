
class SurveylinksController < ApplicationController
  def index

  end

def new
    @surveylink = Surveylink.new
  end


  def create
    @surveylink = Surveylink.new(surveylink_params)

    respond_to do |format|

    if @surveylink.save
      SurveyLinkMailer.welcome_email(@surveylink).deliver
      format.html { redirect_to(@surveylink, notice: 'Surveylink was successfully created.') }
      format.json { render json: @surveylink, status: :created, location: @surveylink }

    else
      render :new
      format.json { render json: @surveylink.errors, status: :unprocessable_entity }
    end
  end
end

  def update
    # @point =
  end

  def show

  end

  def surveylink_params
    params.require(:surveylink).permit(
      :link,
      :survey_code
    )
  end

end
