'use client'
import Image from 'next/image'
import { faWifi, faGear, faDownload, faUpload, faWindowClose, faPlus, IconDefinition } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { apiInstance } from '@/services/api'
import { Fragment, useEffect, useState } from 'react'
import Modal from '@/components/Modal';
import { OrderModal } from './components/OrderModal'
import bgBlank from '../../public/bg-blank.gif';

type Feature = {
  id: number,
  name: string,
  slug: string,
}

type ContentApp = {
  id: number,
  name: string,
  img_src: string,
}

type Plan = {
  id: number,
  qty: string,
  measure: string,
  slug: string,
  time_interval: string,
  price: number,
  is_better: boolean,
  created_at: string,
  updated_at: string,
  features: Feature[],
  content_apps: ContentApp[]
}

type IconMap = {
  [key: string]: IconDefinition;
}

const iconMap: IconMap = {
  'super-wi-fi-6': faWifi,
  'instalacao': faGear,
  'download': faDownload,
  'upload': faUpload,
  'apps-de-conteudo': faWindowClose,
}

export default function Home() {
  const [plans, setPlans] = useState<Plan[]>([]);
  const [modalIsOpen, setModalIsOpen] = useState(false);
  const [selectedPlan, setSelectedPlan] = useState<Plan|null>(null);

  useEffect( () => {
    (async () => {
      const response = await apiInstance.get('/plans');
      setPlans(response.data);
    })()
  }, []);

  return (
    <main className="flex min-h-screen items-center justify-center bg-white space-x-16">
      {plans.map(plan => {
        return (
          <div
            key={plan.id}
            className={`w-72 flex items-center flex-col p-3 border border-indigo-500 rounded-3xl relative ${plan.is_better ? 'bg-indigo-500' : ''}`}
          >
            { plan.is_better
              ? <div className="absolute flex justify-center border-indigo-500 text-indigo-500 border rounded-3xl w-10/12 -top-4 z-10 bg-white">
                  <button className="text-center pt-1 pb-1 pl-7 pr-7">
                    Melhor plano
                  </button>
                </div>
              : null
            }

            <div className="mb-2 mt-6">
              <p className={`text-4xl ${plan.is_better ? 'text-white' : 'text-indigo-500 '}`}>{plan.qty}</p>
            </div>

            <div className="mb-2">
              <p className="text-green-300 text-xl">{plan.measure[0].toUpperCase()}{plan.measure.toLowerCase().substring(1)}</p>
            </div>

            <div className="mb-4 flex space-y-1 flex-col">
              { plan.features.map((feature) => {
                  return (
                    <Fragment key={feature.id} >
                      <div className={`flex items-center justify-center text-indigo-500 space-x-4 ${plan.is_better ? 'text-white' : ''}`}>
                        <div className={`w-3 mr-3 text-green-300`}>
                          <FontAwesomeIcon icon={iconMap[feature.slug]}/>
                        </div>
                        <p>{feature.name}{feature.slug === 'apps-de-conteudo' ? ':' : ''}</p>
                      </div>
                    </Fragment>
                  );
                })                
              }
            </div>

            <div className="mb-4 flex space-x-2 items-center">
              {
                plan.content_apps.map((contentApp) => {
                  return (
                    <div key={contentApp.id} className={`h-[52px] w-[52px] relative`}>
                      <Image
                        src={bgBlank}
                        alt=""
                        className={`absolute h-full w-full border bg-[length:80%_auto] bg-no-repeat bg-center bg-white border rounded ${plan.is_better ? '' : 'border-green-300'}`} 
                        style={{ backgroundImage: `url(${contentApp.img_src})`}}/>
                    </div>
                  );
                })
              }
              { plan.content_apps.length == 3
                ? <div className="flex items-center h-[52px] w-[52px]">
                    <FontAwesomeIcon className="text-green-300 w-10 h-9" icon={faPlus} />
                  </div>
                : null
              }
            </div>

            <div className="text-green-300 mb-4">
              <div className="flex">
                <small className="leading-none mt-2">R$</small>
                <h1 className="text-5xl">{Math.trunc(plan.price)}</h1>
                <div className="flex flex-col items-center self-center">
                  <small className="leading-none">
                    ,{(plan.price % 1 * 100).toFixed(0)}
                  </small>
                  <small className="leading-none">
                    /mês
                  </small>
                </div>
              </div>
              <div className="flex justify-center">
                <small className="leading-none">na conta digital</small>
              </div>
            </div>
          
            <div className={`mb-3 ${plan.is_better ? 'text-white' : 'text-indigo-500'}`}>
              <h5 className="text-sm underline">{"<< Consulte condições >>"}</h5>
            </div>

            <div className={`
              flex transition-colors justify-center text-indigo-500 border-2 rounded-3xl ${plan.is_better ? 'border-white hover:border-green-300' : 'border-indigo-500 bg-white'} p-1`
            }>
              <button
                className={`
                  rounded-3xl transition-colors text-center pt-1 pb-1 pl-7 pr-7 bg-green-400 ${plan.is_better ? 'hover:bg-white' : 'border-white hover:bg-indigo-500 hover:text-white'}
                `}
                onClick={() => {
                    setSelectedPlan(plan);
                    setModalIsOpen(true);
                  }
                }
              >
                Contrate já
              </button>
            </div>
          </div>
        );
      })}

      { selectedPlan ? <OrderModal modalIsOpen={modalIsOpen} onCloseModal={() => setModalIsOpen(false)} planId={selectedPlan?.id} planName={`${selectedPlan?.qty} ${selectedPlan?.measure}`}/> : null}
    </main>
  )
}
