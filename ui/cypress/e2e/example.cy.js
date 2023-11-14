// https://on.cypress.io/api

describe('Visit page', () => {
  it('should visit root', () => {
    cy.visit('/')
    cy.contains('h1', 'Discount Counter')
  })

  it('should visit prices', () => {
    cy.visit('/prices')
    cy.contains('p', 'Prices')
  })

  it('should visit data', () => {
    cy.visit('/data')
    cy.contains('p', 'Shown data:')
  })
})

describe('Select item', () => {
  it('select item from select component', () => {
    cy.visit('/data')
    cy.get('select.selectItem').select('sales')
    cy.get('select.selectItem').should('have.value', 'sales')
  })
})
