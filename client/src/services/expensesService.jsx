// src/services/expensesService.js
import api from "./api";

export const fetchExpenses = async () => {
  try {
    const response = await api.get("/expenses");
    return response.data;
  } catch (error) {
    console.error("Failed to fetch expenses:", error);
    throw error;
  }
};

export const fetchCategory = async () => {
  try {
    const response = await api.get("/category");
    return response.data;
  } catch (error) {
    console.error("Failed to fetch category:", error);
    throw error;
  }
};

export const createExpense = async (expenseData) => {
  try {
    const response = await api.post("/expenses", expenseData);
    return response.data;
  } catch (error) {
    console.error("Failed to create expense:", error);
    throw error;
  }
};
