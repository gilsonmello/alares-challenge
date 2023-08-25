
import { FormEvent, useEffect, useState } from 'react'
import Modal from '@/components/Modal';
import { apiInstance } from '@/services/api'

interface Props {
  modalIsOpen: boolean,
  onCloseModal: () => void,
  planId: number | string,
  planName: string,
}

const initalState = {
  name: '',
  email: '',
  telephone: ''
};

export function OrderModal(props: Props) {
  const [orderForm, setOrderForm] = useState(initalState);
  const [loading, setLoading] = useState(false);

  async function handleOrder(e: FormEvent) {
    e.preventDefault();
    setLoading(true);
    await apiInstance.post('/orders', { ...orderForm, plan_id: props.planId });
    setLoading(false);
    alert('Pedido efetuado com sucesso');
    props.onCloseModal();
    setOrderForm(initalState);
  }
  
  return (
    <Modal isOpen={props.modalIsOpen} onCloseModal={props.onCloseModal} modalTitle={`Solicitar o plano ${props.planName}`}>
      <form onSubmit={handleOrder}>
        <div className="relative p-6 flex-auto">
        <div className="mb-3 pt-0">
          <input
            value={orderForm.name}
            onChange={(v) => setOrderForm((oldState) => ({...oldState, name: v.target.value}))}
            type="text"
            required
            placeholder="Nome"
            className="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"
          />
        </div>
        <div className="mb-3 pt-0">
          <input
            value={orderForm.email}
            onChange={(v) => setOrderForm((oldState) => ({...oldState, email: v.target.value}))}
            type="email"
            required
            placeholder="E-mail"
            className="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"
          />
        </div>
        <div className="mb-3 pt-0">
          <input
            value={orderForm.telephone}
            onChange={(v) => setOrderForm((oldState) => ({...oldState, telephone: v.target.value}))}
            type="text"
            placeholder="Telefone"
            className="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"
          />
        </div>
        </div>

        <div className="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
          <button
            className="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="button"
            onClick={() => props.onCloseModal()}
          >
            Fechar
          </button>
          <button
            className="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
            type="submit"
            disabled={loading}
          >
            Salvar
          </button>
        </div>
      </form>
    </Modal>
  );
}