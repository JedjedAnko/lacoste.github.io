public class prime {
    public static void main(String[] args) {
        int n = Integer.parseInt(args[0]);
        for (int i = 2; i <= n; i++) {
            boolean isPrime = true;
            for (int j = 2; j < i; j++) {
                if (i % j == 0) {
                    isPrime = false;
                    break;
                }
            }
            if (isPrime) {
                System.out.println(i + " ");
            }
        }
        System.out.println();
    }
}