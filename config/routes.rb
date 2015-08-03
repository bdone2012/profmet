Rails.application.routes.draw do
  get 'welcome/index'
  resources :users
  resources :respondents
  resources :surveylinks
  resources :surveycodes
  resources :surveycodekeys
  # The priority is based upon order of creation: first created -> highest priority.
  # See how all your routes lay out with "rake routes".

  # You can have the root of your site routed with "root"
  root 'welcome#index'

  # just the three routes we need
  get  "/session/new"  => "session#new"
  post "/session"      => "session#create"
  get  "/logout"       => "session#destroy"

  get  "/sessionr/new"  => "sessionr#new"
  post "/sessionr"      => "sessionr#create"
  get  "/logoutr"       => "sessionr#destroy"

   post "/surveycode/new"      => "surveylink#update"

end
